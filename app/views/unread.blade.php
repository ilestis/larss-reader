@extends('master')

@section('content')
	<h1>All unread items</h1>
	
	
	@foreach($entries as $entry)
	<div class="entry-container" id="entry-{{$entry->id}}">
		<div class="entry-main @if($entry->status == '1') read @endif">
			<div class="entry-date">{{ $entry->elapsed() }}</div>
			<h2 class="entry-title"><a href="{{ $entry->link }}" target="_blank">{{ $entry->title }}</a></h2>
			<div class="entry-body">{{ $entry->content }}</div>
		</div>
	</div>
    @endforeach
@stop