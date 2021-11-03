<div>
    <h2>
        Page for managers
    </h2>
</div>

<form action="/"> @method('GET')
    <input type="submit" value="Выход">
</form>

<h3>
    Client requests
</h3>
<table>
    @foreach($client_req_info as $info)
        <tr>
            <th>ID:</th>
            <th>Theme:</th>
            <th>Message:</th>
            <th>Client_name:</th>
            <th>Email:</th>
            <th>Created_at:</th>
            <th>Answer to:</th>
        </tr>
        <form action="update_req" method="get">
        <tr>
            <td>{{$info->id}}</td>
            <td>{{$info->theme}}</td>
            <td> {{$info->message}}</td>
            <td> {{$info->client_name}}</td>
            <td> {{$info->email_client}}</td>
            <td> {{$info->created_at}}</td>
            <td>
                    <label>
                        <input type="text" value="{{$info->respo}}" name="respo">
                        <input type="number" value="{{$info->id}}" name="id">
                    </label>

                    <label>
                        <input type="submit" value="Дать ответ">
                    </label>
            </td>
        </tr>
        </form>
    @endforeach
</table>


