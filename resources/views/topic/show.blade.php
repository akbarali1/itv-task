<?php
/**
 * @var \App\ViewModels\TopicShowViewModel $item
 */
?>
@extends('layouts.guest')
@section('content')
    <div class="mt-3">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button text-white" type="button" style="background-color: #161818!important;">
                        {{$item->title}}
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white" style="background-color: #1e1e1e;">
                        {!! $item->hContent !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
