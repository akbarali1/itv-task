<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\ViewModels\SubjectViewModel[] $pagination
 * @var \App\DataObject\SubjectData                                                    $subject
 */
?>

@extends('layouts.app')
@section('content')
    @php
        $subject = $item['subject'];
    @endphp
        <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ $subject->title }} - @lang('form.topic')</h5>
                    <div>
                        <a href="{{ route('subject.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="c-icon c-icon-sm cil-arrow-left"></i> @lang('form.back_to_subjects')
                        </a>
                        <a class="btn btn-sm btn-success" href="{{ route('subject.topic.create',$subject->id) }}">
                            <i class="c-icon c-icon-sm cil-plus"></i> @lang('form.add')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped table-sm">
                        <thead>
                        <tr>
                            <th class="b-t-0">ID</th>
                            <th class="b-t-0">@lang('form.title')</th>
                            <th class="b-t-0">@lang('form.content')</th>
                            <th class="b-t-0">@lang('form.created_at')</th>
                            <th class="b-t-0" width="5px"></th>
                            <th class="b-t-0" width="5px"></th>
                            <th class="b-t-0" width="5px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pagination as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->createdAt }}</td>
                                <td>
                                    <a href="{{ route('subject.topic.edit',['subject_id' => $subject->id, 'id' => $item->id]) }}"
                                       class="btn btn-sm btn-info text-white">
                                        @lang('form.edit')
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('subject.topic.delete', ['subject_id' => $subject->id, 'id' => $item->id]) }}"
                                       class="btn btn-sm btn-danger text-white" data-action="delete">
                                        @lang('form.delete')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">@lang('form.no_data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav>
                        {{ $pagination->links() }}
                    </nav>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@endsection
