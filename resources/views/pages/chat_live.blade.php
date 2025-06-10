@foreach ($messages as $msg)
    @if (isset($msg['fields']['userId2']['stringValue']) && $msg['fields']['userId2']['stringValue'] == $data['ticketId'])
        <div class="chat__box__text-box flex items-end float-left mb-4">
            <div class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                {{ $msg['fields']['message']['stringValue'] ?? '' }}
            </div>
        </div>
        <div class="clear-both"></div>
    @else
        <div class="chat__box__text-box flex items-end mb-4" style="float: right">
            <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md ">
                {{ $msg['fields']['message']['stringValue'] ?? '' }}
            </div>
        </div>
        <div class="clear-both"></div>
    @endif
@endforeach