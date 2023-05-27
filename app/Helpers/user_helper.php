<?php

function isManager(): bool{
    return (session()->get('role') == 'manager');
}
function isContractor(): bool{
    return (session()->get('role') == 'contractor');
}
function isClient(): bool{
    return (session()->get('role') == 'client');
}

function isSuperAdmin(): bool
{
    //GET IT FROM THE FIELD IS_SUPER_ADMIN FROM MANAGER
    return true;
}

function isLoggedIn(): bool{
    return ((session()->get('id')) !== null);
}