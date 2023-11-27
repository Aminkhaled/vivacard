
 <table>
    <thead>
    <tr>
        <th>categories_code</th>
        <th>categories_name_ar</th>
        <th>categories_name_en</th>
        <th>category_parent_code</th>
        <th>categories_position</th>
        <th>categories_status</th>

    </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->categories_code}}</td>
                @foreach ($category->translations->sortBy('locale') as $categoryTrans)
                    <td>{{ $categoryTrans->categories_name}}</td>
                @endforeach
                <td>{{$category->category ? $category->category->categories_code : '' }}</td>
                <td>{{$category->categories_position }}</td>
                <td>{{$category->categories_status }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
