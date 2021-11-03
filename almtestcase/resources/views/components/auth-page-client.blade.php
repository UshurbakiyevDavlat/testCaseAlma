<div>
    <h2>
        Page for clients
    </h2>

    <form action="/"> @method('GET')
        <input type="submit" value="Выход">
    </form>

    <h3>
        Client requests
    </h3>
    <table>
        @foreach($client_req_info as $info)
            <tr>
                <th>Theme:</th>
                <th>Message:</th>
                <th>Client_name:</th>
                <th>Email:</th>
                <th>Created_at:</th>
                <th>Answer:</th>
            </tr>
            <tr>
                <td>{{$info->theme}}</td>
                <td> {{$info->message}}</td>
                <td> {{$info->client_name}}</td>
                <td> {{$info->email_client}}</td>
                <td> {{$info->created_at}}</td>
                <td> {{$info->respo}}</td>
            </tr>
        @endforeach
    </table>

    <h2>Make request</h2>
    <form action="make_req" method="get">
        <label>
            Theme: <input type="text" name="theme">
        </label>
        <label>
            Message: <input type="text" name="message">
        </label>
        <label>
            Client_name: <input type="text" name="client_name">
        </label>
        <label>
            Email: <input type="email" name="email_client">
        </label>
        <input type='submit' value="Make request to manager!">
    </form>
</div>
