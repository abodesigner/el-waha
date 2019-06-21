@extends('layouts.app1')
@section('content')
    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ $title }}
                            @can('add_queries')
                                <a href="{{route('queries.create')}}" class="btn btn-primary btn-xs"><i
                                            class="fa fa-plus"></i> {{ trans('queries.create_new') }} </a>
                            @endcan
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>{{ trans('queries.query') }}</th>
                                <th>{{ trans('queries.platform') }}</th>
                                <th>{{ trans('queries.category') }}</th>
                                <th>{{ trans('queries.from') }}</th>
                                <th>{{ trans('queries.to') }}</th>
                                <th>{{ trans('queries.type') }}</th>
                                <th>{{ trans('queries.status') }}</th>
                                <th>{{ trans('queries.query_results_count') }}</th>
                                @if ( Auth::user()->can('edit_queries') || Auth::user()->can('delete_queries') )
                                    <th>{{ trans('queries.action') }}</th>
                                @endif
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{ trans('queries.query') }}</th>
                                <th>{{ trans('queries.platform') }}</th>
                                <th>{{ trans('queries.category') }}</th>
                                <th>{{ trans('queries.from') }}</th>
                                <th>{{ trans('queries.to') }}</th>
                                <th>{{ trans('queries.type') }}</th>
                                <th>{{ trans('queries.status') }}</th>
                                <th>{{ trans('queries.query_results_count') }}</th>
                                @if ( Auth::user()->can('edit_queries') || Auth::user()->can('delete_queries') )
                                    <th>{{ trans('queries.action') }}</th>
                                @endif
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(count($queries))
                                @foreach ($queries as $row)

                                    <tr>
                                        <td class="text-center">
                                            {!! $row->is_comparator?"<span class='label label-info' title='Comparator'><i class='fa fa-line-chart'></i></span>":"" !!}
                                            <a href="{{ route('queries.show', ['id' => $row->id]) }}"
                                               title="{{ trans('queries.show_query_results') }}">{{$row->title}}</a>
                                        </td>
                                        <td class="text-center">{{$row->platform_id ? $row->platform->name : trans('queries.all')}}</td>
                                        <td class="text-center">{{$row->category_id ? $row->category->name : trans('queries.all')}}</td>
                                        <td class="text-center">{{$row->from}}</td>
                                        <td class="text-center">{{$row->to}}</td>
                                        <td class="text-center">{{$row->type}}</td>
                                        <td class="text-center">{!! $row->active ? "<span class='label label-success'>".trans('queries.active')."</span>" :"<span class='label label-success'>". trans('queries.disactive')."</span>" !!}</td>

                                        <td class="text-center">
                                            <a href="#" class="text-center text-warning" role="button"
                                                                   data-placement="top"
                                                                   data-html="true"
                                                                   data-toggle="popover"
                                                                   data-trigger="focus"
                                                                   title="Results"
                                                                   data-content="Results :<span class='label label-default'>{{ $row->total}}</span>
                                                                   <br><span class='label label-success'> Positive :{{count_results($row->total,$row->pos)}}%</span>
                                                                   <br><span class='label label-danger'> Negative :{{count_results($row->total,$row->neg)}}%</span>
                                                                   <br><span class='label label-warning'> Natural :{{count_results($row->total,$row->nat)}}% </span>">
                                                {{$row->total}}</a>
                                        </td>
                                        @if ( Auth::user()->can('edit_platforms') || Auth::user()->can('delete_platforms') )
                                            <td>
                                                <div class="btn-group">

                                                    @can('edit_queries')
                                                        <a href="{{ route('queries.edit', ['id' => $row->id]) }}"
                                                           class="btn btn-info btn-xs"><i class="fa fa-pencil"
                                                                                          title="{{ trans('queries.edit') }}"></i> {{ trans('queries.edit') }}
                                                        </a>
                                                    @endcan
                                                    @can('delete_queries')
                                                        {!! Form::button('<i class="fa fa-trash-o" title="'.trans('queries.delete').'"></i> '.trans('queries.delete').'', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','form'=>"deleteQueriesForm_{$row->id}"]) !!}
                                                    @endcan
                                                </div>
                                                @can('delete_queries')
                                                    {!! Form::open(['url' => route('queries.destroy', ['id' => $row->id]), 'method' => 'post','name'=>"deleteQueriesForm_{$row->id}",'id'=>"deleteQueriesForm_{$row->id}"]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}

                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer-scripts')
    <script>
        $('[data-toggle="popover"]').popover();
    </script>
@stop
