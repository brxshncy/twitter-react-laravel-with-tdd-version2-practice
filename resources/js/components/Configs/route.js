import React from 'react';
import Login from '../pages/Login';
import  Signup  from '../pages/Signup';


const routes = [
    {
        path: '/login',
        component: Login,
        isPrivate: false
    },
    {
        path: '/signup',
        component: Signup,
        isPrvate: false
    }
    
]

export default routes