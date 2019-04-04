<div style="text-align: center">
    <h1>PASSWORD RECOVERY FOR THE ACCOUNT</h1>

    <p>
        Dear user, you have applied for a password recovery to access your account!<br/>Click the button below to continue:
    </p>
    <a target="_blank" href="{{ route('auth.reset.password').'?token='.$token }}" style="padding: 10px; border-radius: 5px; display: inline-block; background: green; color: white; text-decoration: none">New password</a>
</div>