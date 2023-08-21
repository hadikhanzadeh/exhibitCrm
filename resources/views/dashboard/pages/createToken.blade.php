<form action="{{ route('dashboard.generateToken') }}" method="post">
    @csrf
    <label for="">Token Name</label>
    <input name="token_name" type="text" placeholder="choose a name for your token">
    <input type="submit" value="Generate Token">

</form>
