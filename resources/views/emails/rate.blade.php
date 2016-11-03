<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Rate Limit Breached</h1>
        <p>
            A user has breached the rate limit.
        </p>
        <p>
            route:   {{ $route }}
            <br />
            api_key: {{ $api_key }}
            <br />
            ip:      {{ $ip }}
        </p>
    </body>
</html>