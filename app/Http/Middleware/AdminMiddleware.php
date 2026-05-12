<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   public function handle(Request $request, Closure $next): Response
{
    // إذا لم يكن المستخدم مديراً، لا تمنعه، فقط دعه يمر (للعملاء)
    // الحماية ستكون معتمدة فقط على الـ Routes في web.php
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        // بدلاً من abort، نقوم بتحويل العميل للصفحة الرئيسية
        return redirect()->route('home');
    }

    return $next($request);
}
}
