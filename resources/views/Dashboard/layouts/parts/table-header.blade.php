<h5 class="panel-title" dir="{{ direction() }}" style="float: {{ floating('right', 'left') }};">
    @lang('messages.'.str()->singular($name).'.'.$name) ({{ $collection->count() }})
</h5>
<ul class="breadcrumb-elements" dir="{{ direction() }}" style="float: {{ floating('left', 'right') }};">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear position-left"></i></a>

        <ul class="dropdown-menu dropdown-menu-right">
            <li>
                <a href=""><i class="icon-file-excel"></i> @lang('back.export-csv')</a>
            </li>
            @if($name != 'settings')
                <li>
                	<a href="{{ route($name.'.create') }}"><i class="icon-plus3"></i> @lang('messages.add')</a>
                </li>
            @endif
        </ul>
    </li>
</ul>

{{--{{ route($name.'.export') }}--}}
