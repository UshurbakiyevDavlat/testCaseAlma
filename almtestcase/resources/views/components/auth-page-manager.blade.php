<div>
    <h2>
        Page for managers
    </h2>
</div>

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
