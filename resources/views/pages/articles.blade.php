<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset="UTF-8">
    <title> Artikel </title>

</head>

<table>
    <tr>
        <th> id </th>
        <th> ab_name </th>
        <th> ab_price </th>
        <th> ab_description </th>
        <th> ab_creator_id </th>
        <th> ab_createdate </th>
        <th> picture </th>
    </tr>

    @foreach ($articles as $article)
        <tr>
            <td> {{ $article["id"] }} </td>
            <td> {{ $article["ab_name"] }} </td>
            <td> {{ $article["ab_price"] }} </td>
            <td> {{ $article["ab_description"] }} </td>
            <td> {{ $article["user_id"] }} </td>
            <td> {{ $article["ab_createdate"] }} </td>


            @if (file_exists("articelpictures/$article[id].jpg"))
                <td> <img src='articelpictures/{{$article["id"]}}.jpg' alt="{{ $article["ab_name"] }}"> </td>
            @else
                <td> <img src='articelpictures/{{$article["id"]}}.png' alt="{{ $article["ab_name"] }}"> </td>
                @endif
        </tr>
    @endforeach
</table>

{{-- Dies ist ein Test... Es soll geprüft werden ob ich nun das geänderte Projekt pushen kann --}}


</html>
