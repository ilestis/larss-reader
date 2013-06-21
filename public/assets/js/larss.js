var currentEntry = null; 
/**
 * Next/Previous bindings 
 **/ 
$(document).ready(function() { 
	$(document).keyup(function(e) { 
		var code = (e.keyCode ? e.keyCode : e.which); 
		// Next 
		if(code == 78 || code == 74) { 
			if(!currentEntry) { // Get first 
				nextEntry = getFirst(); 
			} else { 
				nextEntry = getNext(); 
			} 
			if(nextEntry) { 
				currentEntry = nextEntry; 
				var pos = $("#"+currentEntry).offset(); 
				$('body').scrollTop(pos.top); 
				setMarked(currentEntry); 
				} 
			} 
		// Previous 
		else if(code == 80 || code == 75) { 
			if(currentEntry) { 
				currentEntry = getPrevious(); 
			} 
			if(currentEntry) { 
				var pos = $("#"+currentEntry).offset(); 
				$('body').scrollTop(pos.top); 
			} 
		} 
	});
	
	/** * When we scroll down, mark elements as read 
	 * */ 
	$(document).bind('mousewheel', function(e){ 
		if(e.originalEvent.wheelDelta /120 < 0) { 
			if(!currentEntry) { 
				currentEntry = getFirst(); 
			} 
			if(currentEntry) { 
				// Check if we've scrolled past the next item 
				var nextPos = $('#'+currentEntry).offset(); 
				var curPos = $('body').scrollTop()+120; 
				if(curPos > nextPos.top) { 
					setMarked(currentEntry); 
					nextEntry = getNext(); 
					if(nextEntry) { 
						currentEntry = nextEntry; 
					} 
				} 
			} 
		} 
	}); 
	
	if($('#refresh-btn')) { 
		$('#refresh-btn').click(function() { 
			refresh(); 
			return false; 
		}); 
		} 
	}); 

/** * Calls the script to pull new entries */ 
function pull(refresh) { 
	$.ajax({ 
		url: '/rss/pull/'
	}).done(function ( data ) { 
		refresh_unread(data);
		$('#updating').html('');
	}); 
	return false; 
} 

/** * Gets the unread count from the categories */ 
function refresh_unread(data) { 
	var binding = '';
	$('#nav-total-count').html(data.all); 
	
	// Sections 
	jQuery.each(data.section, function(i, val) { 
		binding = '#nav-section-count-'+i; 
		$(binding).html(val); if(val > 0) { 
			$('#nav-section-link-'+i).addClass('unread');
		} else { 
			$('#nav-section-link-'+i).removeClass('unread');
		}
	});	 
	// Feed 
	jQuery.each(data.feed, function(i, val) { 
		binding = '#nav-feed-count-'+i; $(binding).html(val); 
		if(val > 0) { 
			$('#nav-feed-link-'+i).addClass('unread');
		} 
		else { 
			$('#nav-feed-link-'+i).removeClass('unread');
		}
	});	 
	
} 

function get_unread() { 
	$.ajax({
		url: '/rss/unread'
	}).done(function ( data ) { 
		refresh_unread(data);
	}); 
	return false; 
}

/** * Refreshes the current view */
function refresh() { $('#updating').html('Updating...'); pull(); } 

/** * Get the first entry on the page * @returns */
function getFirst() { current = false; $(".entry-container").each(function( index, ele ) { current = $(ele).attr('id'); return false; }); return current; }

function getNext() { 
	current = found = false;
	$(".entry-container").each(function( index, ele ) { 
		if($(ele).attr('id') == currentEntry) { 
			found = true;
		} else if(found) { 
			current = $(ele).attr('id');
			return false; 
		}
	});
	return current;
}

function getPrevious() { 
	previous = false; 
	$(".entry-container").each(function( index, ele ) { 
		if($(ele).attr('id') == currentEntry) { return false; } 
		previous = $(ele).attr('id'); }); return previous; }

/** * Set entry as marked * @param ele */ 
function setMarked(ele) { 
	var elements = ele.split('-');
	$.ajax({ url: '/entry/'+elements[1]+'/read', }).done(function ( data ) { // tag element 
		var target = '#entry-'+data; $(target).addClass('read'); 
		// Get new unread count 
		get_unread(); 
	});
} 

/** * Mark all current shown items as read * @param type * @param id */
function markAsRead(type, id) { // Build IDs from visible elements 
	var entry_ids = []; 
	var names = ''; 
	var element_id = 0; 
	
	$(".entry-container").each(function( index, ele ) { 
		element_id = $(ele).attr('id'); 
		names = element_id.split('-'); 
		entry_ids.push(names[1]);
	}); 
	console.log(entry_ids); 
	$.ajax({ url: '/entry/readall/'+entry_ids.join('|') }).done(function() {
		window.location = window.location;
	}); 
	return false; 
}
