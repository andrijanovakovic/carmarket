{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
<div class="card" style="width: 30%">
    <div class="card-header">
        Register
    </div>
    <div class="card-body">
        <form class="register_register_form" action="{{ urlFor('register.post')}}" method="post" autocomplete="on">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}"
                    {% endif %} />
                <small id="email_help" class="form-text text-muted">E-mail is required, later on you can use e-mail or
                    username to login.</small>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" {% if request.post('username') %}
                    value="{{ request.post('username') }}" {% endif %} />
                <small id="username_help" class="form-text text-muted">Username should be at least 8 characters long.</small>
                <small id="username_help" class="form-text text-muted">Username can contain alphanumeric characters,
                    dashes and hyphens.</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
                <small id="password_help" class="form-text text-muted">We advise you to choose a strong password.</small>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirm password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" />
                <small id="username_help" class="form-text text-muted">This field must contain the same value as the
                    field above.</small>
            </div>

            {% if errors %}
            <div class="form-group">
                {% for error in errors.all %}
                <p class="register_register_error">{{ error }}</p>
                {% endfor %}
            </div>
            {% endif %}

            <div style="margin-top: 40px" style="width: 100%;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
            </div>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>

</div>
{% endblock %}