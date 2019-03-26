{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}

<div class="card" style="width: 30%">
    <div class="card-header">
        Login
    </div>
    <div class="card-body">
        <form class="register_register_form" action="{{ urlFor('login.post')}}" method="post" autocomplete="on">
            <div class="form-group">
                <label for="identifier">Username or E-mail</label>
                <input type="text" class="form-control" name="identifier" id="identifier" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember_me">
                <label class="custom-control-label" for="remember_me">Remember me</label>
            </div>

            <div style="margin-top: 40px" style="width: 100%;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </div>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>
</div>
{% endblock %}
