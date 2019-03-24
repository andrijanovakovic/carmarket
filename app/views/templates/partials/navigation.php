<div class="navigation_main_navbar_container">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ urlFor('home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ urlFor('categories') }}">Categories</a>
        </li>

        {% if auth %}
            <li class="nav-item">
                <a class="nav-link" href="{{ urlFor('create_advert') }}">Create new advert</a>
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
        {% endif%}
    </ul>
</div>
