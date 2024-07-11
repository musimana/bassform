<?php

namespace App\Enums\Webpages;

enum WebpageTemplate: string
{
    /* List of the webpage templates available to the application. */
    case ADMIN_CREATE_EDIT = 'Admin/AdminCreateEdit';
    case AUTH_EMAIL_VERIFY = 'Auth/AuthEmailVerify';
    case AUTH_LOGIN = 'Auth/AuthLogin';
    case AUTH_PASSWORD_CONFIRM = 'Auth/AuthPasswordConfirm';
    case AUTH_PASSWORD_FORGOT = 'Auth/AuthPasswordForgot';
    case AUTH_PASSWORD_RESET = 'Auth/AuthPasswordReset';
    case AUTH_REGISTER = 'Auth/AuthRegister';
    case PROFILE_DASHBOARD = 'Profile/ProfileDashboard';
    case PROFILE_EDIT = 'Profile/ProfileEdit';
    case PUBLIC_CONTENT = 'Public/PublicContent';
    case PUBLIC_CONTENT_CONTROLS = 'Public/PublicContentControls';
    case PUBLIC_CONTENT_FORMS = 'Public/PublicContentForms';
    case SITEMAP_INDEX = 'sitemaps/default';
    case SITEMAP_ITEMS = 'sitemaps/items';

    /** Get the template's filepath. */
    public function filepath(): string
    {
        return match ($this) {
            self::SITEMAP_INDEX, self::SITEMAP_ITEMS => resource_path('views/' . $this->value . '.blade.php'),
            default => resource_path('js/Pages/' . $this->value . '.vue'),
        };
    }
}
