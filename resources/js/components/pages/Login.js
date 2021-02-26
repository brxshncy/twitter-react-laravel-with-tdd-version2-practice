import React,  {useContext, useState} from 'react';
import { useAuthState } from '../Context/AuthContext';
import { authAction } from '../Context/Actions/apiAction';



const Login = () => {

    const { data, dispatch } = useAuthState()

    const [loginData, setLoginData] = useState({
        email:'',
        password:''
    })

    const handleLogin = (e) => {
        e.preventDefault();

        authAction.login('api/login', dispatch, loginData)

    
    }
    console.log(data.error.message)
    return(
        <>
            <form onSubmit={handleLogin}>

                <input type="text" 
                        onChange={ e => setLoginData({...loginData, email: e.target.value})}
                        value={loginData.email} />

                    <input type="text" 
                            onChange={e => setLoginData({...loginData, password: e.target.value})}
                            value= {loginData.password} />
                        
                    <button type="submit">Login</button>
                    
            </form>
            { data.error.message }
       </>

    )
}

export default Login;