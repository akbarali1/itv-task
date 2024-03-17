<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection|\App\DataObject\SubjectData[] $subjects
 */
?>
@extends('layouts.guest')
@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height:100vh;">
        <div class="row">
            @foreach($subjects as $subject)
                <div class="col-md-6  p-3 text-white">
                    <div class="border rounded p-3 w-100 h-100">
                        <h5>{{ $subject->title }}</h5>
                        @if(count($subject->topics) > 0)
                            <ul class="list-unstyled">
                                @foreach($subject->topics as $topic)
                                    <li>
                                        <a href="{{ route('topic.show', $topic->id) }}" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer">
                                            {{ $topic->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
