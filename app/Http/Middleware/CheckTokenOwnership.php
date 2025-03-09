<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\Token\TokenNotFoundException;
use App\Exceptions\Token\TokenNotOwnedByUserException;
use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws TokenNotFoundException
     * @throws TokenNotOwnedByUserException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenId = $request->route('token_id');

        $token = Token::query()
            ->find($tokenId);

        if (!$token) {
            throw new TokenNotFoundException('Token not found');
        }

        if ($token->user_id !== auth()->id()) {
            throw new TokenNotOwnedByUserException('The token does not belong to the current user');
        }

        return $next($request);
    }

}
