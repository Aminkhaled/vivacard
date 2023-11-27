

 <table>
    <thead>
        <tr>
            <th>coupons_code</th>
            <th>stores_code</th>
            <th>offers_code</th>
            <th>categories_codes</th>
            <th>countries_codes</th>
            <th>coupons_image</th>
            <th>coupons_available</th>
            <th>coupons_is_special</th>
            <th>coupons_status</th>
            <th>coupons_position</th>
            @foreach($langs as $lang)
                <th>coupons_name_{{$lang->locale}}</th>
            @endforeach
            @foreach($langs as $lang)
                <th>coupons_long_name_{{$lang->locale}}</th>
            @endforeach
            @foreach($langs as $lang)
                <th>coupons_desc_{{$lang->locale}}</th>
            @endforeach
            @foreach($langs as $lang)
                <th>coupons_offers_desc_{{$lang->locale}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->coupons_code }}</td>
            <td>{{ $coupon->store ? $coupon->store->stores_code : '' }}</td>
            <td>{{ $coupon->offers_id }}</td>
            <td>
                @foreach($coupon->categories as $key => $category)
                    @if($key > 0) , @endif
                    {{$category->categories_code}}
                @endforeach    
            </td>
            <td>
                @foreach($coupon->countries as $key => $country)
                    @if($key > 0) , @endif
                    {{$country->countries_code}}
                @endforeach    
            </td>
            <td>{{ $coupon->coupons_image }}</td>
            <td>{{ $coupon->coupons_available }}</td>
            <td>{{ $coupon->coupons_is_special }}</td>
            <td>{{ $coupon->coupons_status }}</td>
            <td>{{ $coupon->coupons_position }}</td>

            @foreach ($coupon->translations->sortBy('locale') as $couponTrans)
                <td>{!! $couponTrans->coupons_name!!}</td>
            @endforeach
            @foreach ($coupon->translations->sortBy('locale') as $couponTrans)
                <td>{!! $couponTrans->coupons_long_name!!}</td>
            @endforeach
            @foreach ($coupon->translations->sortBy('locale') as $couponTrans)
                <td>{!! $couponTrans->coupons_desc!!}</td>
            @endforeach
            @foreach ($coupon->translations->sortBy('locale') as $couponTrans)
                <td>{!! $couponTrans->coupons_offers_desc!!}</td>
            @endforeach

        </tr>
    @endforeach
    </tbody>
</table>
