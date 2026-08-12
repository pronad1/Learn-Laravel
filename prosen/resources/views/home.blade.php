
@include('common.header')
<h1>Home Page </h1>
<!-- <a href="/">Welcome Page</a>
<a href="/about/prosen">About Page</a> -->

<x-message-banner msg="User Login Successfully"/>
<x-message-banner msg="User Signup Successfully"/>


<style>
    .success{
        background-color: lightgreen;
        color: green;
        padding: 3px 10px;
        border-radius: 3px;
        display: inline-block;
        margin: 10px;
    }
</style>