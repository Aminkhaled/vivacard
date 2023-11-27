

 <table>
    <thead>
    <tr>
        <th>daily_offers_code</th>
        <th>stores_code</th>
        <th>daily_offers_name_ar</th>
        <th>daily_offers_name_en</th>
        <th>daily_offers_image</th>
        <th>daily_offers_url</th>
        <th>daily_offers_price</th>
        <th>daily_offers_price_before_sale</th>
        <th>daily_offers_status</th>
        <th>daily_offers_position</th>
    </tr>
    </thead>
    <tbody>
    @foreach($daily_offers as $daily_offer)
        <tr>
            <td>{!! $daily_offer->daily_offers_code!!}</td>
            <td>{!! $daily_offer->store ? $daily_offer->store->stores_code : ''!!}</td>
            @foreach ($daily_offer->translations->sortBy('locale') as $daily_offerTrans)
                <td>{!! $daily_offerTrans->daily_offers_name!!}</td>
            @endforeach
            <td>{!! $daily_offer->daily_offers_image!!}</td>
            <td>{!! $daily_offer->daily_offers_url!!}</td>
            <td>{!! $daily_offer->daily_offers_price!!}</td>
            <td>{!! $daily_offer->daily_offers_price_before_sale!!}</td>
            <td>{!! $daily_offer->daily_offers_status!!}</td>
            <td>{!! $daily_offer->daily_offers_position!!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
