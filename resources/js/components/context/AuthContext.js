import React, { createContext, useContext, useReducer } from 'react'
import {AuthReducer} from '../Reducers/AuthReducer';
import { apiActions } from './Actions/apiAction';


const initialState = { 

   userData: {},
   error: {},
   isInvalid: false

}

export const AuthContext = createContext();


export function useAuthState() {
    
    let context = useContext(AuthContext)
    
    if (context === undefined) {
        throw new Error("useAuthState must be used with in Auth Context Provider")
    }
    return context;
}

export const AuthContextProvider = ( props ) => {

    const [data, dispatch] = useReducer(AuthReducer, initialState)



   
    return(

        <AuthContext.Provider value={{  data, dispatch }}>

            { props.children }

        </AuthContext.Provider>
    )
}