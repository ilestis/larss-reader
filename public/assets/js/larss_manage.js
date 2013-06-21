		
			

/** * Next/Previous bindings */ 

$(document).ready(function() { 
	if($('#refresh-btn')) { 
		$('#refresh-btn').click(function() { 
			refresh(); 
			return false;
			});
		} 
	
	if($('#feed_add')) { 
		$('#feed_add').click(function() { 
			feedEdit(0); 
			return false; 
			});
		} 
	if($('#section_add')) {
		$('#section_add').click(function() { 
			sectionEdit(0); 
			return false; 
			});
		}
	}); 

/** * Edit feed form * @param id */ 
function feedEdit(id) { 
	$.ajax({ url: '/feed/form/'+id, }).done(function ( data ) { // tag element 
		$('#feed-edit').html(data); 
		$('#feed-edit').modal(); 
	}); 
} 

/** * Edit section form * @param id */ 
function sectionEdit(id) { 
	$.ajax({ url: '/section/form/'+id, }).done(function ( data ) { // tag element 
		$('#section-edit').html(data); 
		$('#section-edit').modal(); 
	}); 
}
	
	