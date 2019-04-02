<div class="navigation_main_navbar_container">
    <ul class="nav nav_bar">
        <li class="nav-item">
            <a class="nav-link active" href="{{ urlFor('home') }}">Home</a>
        </li>

        {% if auth %}
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('create_advert') }}">Create new advert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('my_adverts') }}">My adverts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('comments') }}">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('all_users') }}">All users</a>
            </li>

            <li class="nav-item" style="margin-left: 60px">
                <a class="nav-link disabled" href="#">Logged in with {{auth.email}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('logout') }}">Logout</a>
            </li>
        {% else %}  
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('register') }}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('comments') }}">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('all_users') }}">All users</a>
            </li>
        {% endif%}
    </ul>
</div>
