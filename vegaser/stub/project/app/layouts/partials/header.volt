<div class="header clearfix">
    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="{{ url.get(['for': 'root']) }}">Home</a></li>
            <li role="presentation"><a href="{{ url.get(['for': 'login']) }}">Sign in</a></li>
            <li role="presentation"><a href="{{ url.get(['for': 'register']) }}">Sign up</a></li>
            {% if authorization.isAuthenticated() %}
            <li role="presentation"><a href="{{ url.get(['for': 'logout']) }}">Logout</a></li>
            {% endif %}
        </ul>
    </nav>
    <h3 class="text-muted">Vegas CMF 2.0 Demo Application</h3>
</div>
