
 <table>
    <thead>
        <tr>
            <th>{{ __('general::lang.id') }}</th>
            <th>{{ __('general::lang.name') }}</th>
            <th>{{ __('general::lang.phone') }}</th>
            <th>{{ __('general::lang.email') }}</th>
            <th>{{ __('general::lang.type') }}</th>
            <th>{{ __('services::lang.orders_id') }}</th>
            <th>{{ __('general::lang.status') }}</th>
            <th>{{ __('general::lang.date') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contactus as $contact)
            <tr>
                <td>{{ $contact->contact_us_id   }}</td>
                <td>{{ $contact->contact_us_name  }}</td>
                <td>{{ $contact->contact_us_phone }}</td>
                <td>{{ $contact->contact_us_email }}</td>
                <td> {{$contact->contact_us_type ?  __('services::lang.'.$contact->contact_us_type) : ''}}</td>
                @if ($contact->order)
                    <td>{{$contact->order->orders_id }}</td>
                @else
                    <td>--</td>
                @endif
                @if ($contact->contact_us_status == 0)
                    <td>{{__('general::lang.new') }}</td>
                @else
                <td>{{ __('general::lang.done') }}</td>
                @endif
                <td>{{  Carbon\Carbon::parse($contact->contact_us_created_at)->timezone(env('timezone','Africa/Cairo'))->format('Y-m-d h:m:s a') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
