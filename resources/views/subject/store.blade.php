<?php
/**
 * @var \App\ViewModels\SubjectViewModel $item
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">
                        {{ trans(isset($item->id) ?  "form.editing_item" : "form.creating_item") }}
                    </h5>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route("subject.index") }}">
                        <i class="c-icon c-icon-sm cil-arrow-left"></i> @lang('form.back')
                    </a>
                </div>
                <form class="form-horizontal" action="{{ isset($item->id) ? route('subject.update', $item->id) : route('subject.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="title">@lang('form.title')</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="title" type="text" name="title" value="{{ old('title', $item->title ?? "") }}"
                                               placeholder="@lang('form.title')" autocomplete="off" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="description">@lang('form.description')</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="description" type="description" name="description"
                                                  placeholder="@lang('form.description')" autocomplete="off">{{ old('description', $item->description ?? "") }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success" type="submit">
                            <i class="c-icon c-icon-sm cil-save"></i>
                            @lang('form.save')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
