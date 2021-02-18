import React, { createContext, useState, useEffect } from 'react';



export const AuthContext = createContext();

export const AuthContextProvider = ( props ) => {

    const [data, setData] = useState("test")
    return (
        
        <AuthContext.Provider value={{ data }}>

            { props.children }

        </AuthContext.Provider>
    )
}