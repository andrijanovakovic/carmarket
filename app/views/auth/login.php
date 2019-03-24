{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}

<div class="card" style="width: 30%">
    <div class="card-header">
        Login
    </div>
    <div class="card-body">
        <form class="register_register_form" action="{{ urlFor('login.post')}}" method="post">
            <div class="form-group">
                <label for="identifier">Username or E-mail</label>
                <input type="text" class="form-control" name="identifier" id="identifier" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
            </div>

            <div class="form-group">
                <label for="remember_me">Remember me</label>
                <input type="checkbox" class="form-control" name="remember_me" id="remember_me" />
            </div>

            <div style="margin-top: 40px" style="width: 100%;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </div>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>
</div>
{% endblock %}
