import React, { useState } from 'react'

const Signup = () => {

    const [formData, setFormData] = useState({
        emai:'',
        name:'',
        password:''
    })
    return (
        <div>
                <form action="">
                    <input type="text"
                            value={ formData.email }
                            onChange={ e => setFormData({...formData, email: e.target.value}) }/>
                    <input type="text"
                           value={ formData.name }
                           onChange={ e => setFormData({...formData, name: e.target.value})}/>
                    <input type="password"
                           value={ formData.password }
                           onChange={ e => setFormData({...formData, password: e.target.value})}/>
                    <button type="submit">Signup</button>
                </form>
        </div>
    )
}

export default Signup;