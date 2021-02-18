import React, {useContext} from 'react';
import { AuthContext } from '../context/AuthContext';

const Login = () => {

    const { data } = useContext(AuthContext);
    return(

        <div>
            { data }
        </div>
    )
}

export default Login;