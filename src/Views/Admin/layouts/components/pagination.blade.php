<div class="col-sm-12 col-md-5">
    <div class="dataTables_info" id="customerList-table_info" role="status" aria-live="polite">
        Showing {{ $page }} to {{ $page }} of {{ $totalPage }} entries
    </div>
</div>

<div class="col-sm-12 col-md-7">
    <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="customerList-table_paginate">
        <ul class="pagination">

            @if($page == 1)
            <li class="paginate_button page-item previous disabled" id="customerList-table_previous">
                <a aria-controls="customerList-table" aria-disabled="true" role="link" data-dt-idx="previous"
                    tabindex="-1" class="page-link">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            </li>

            @else
            <li class="paginate_button page-item previous" id="customerList-table_previous">
                <a href="{{ routeAdmin("{$url}" . $page - 1) }}" aria-controls="customerList-table" aria-disabled="true" role="link" data-dt-idx="previous"
                    tabindex="-1" class="page-link">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            </li>
            @endif

            @for($i = 1; $i <= $totalPage; $i++) <li class="paginate_button page-item {{ $page == $i ? "active" : '' }}">
                <a href="{{ routeAdmin("{$url}" . $i) }}" aria-controls="customerList-table" class="page-link">
                    {{ $i }}
                </a>
                </li>
                @endfor

                @if($page == $totalPage)
                <li class="paginate_button page-item disabled" id="customerList-table_next">
                    <a href="#" aria-controls="customerList-table" role="link" data-dt-idx="next" tabindex="0"
                        class="page-link">
                        <i class="mdi mdi-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="paginate_button page-item" id="customerList-table_next">
                    <a href="{{ routeAdmin("{$url}" . ++$page) }}" aria-controls="customerList-table" role="link" data-dt-idx="next" tabindex="0"
                        class="page-link">
                        <i class="mdi mdi-chevron-right"></i>
                    </a>
                </li>
                @endif
        </ul>
    </div>
</div>