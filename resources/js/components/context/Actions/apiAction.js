import React from 'react';
import axios from "axios"
import { useAuthState } from "../AuthContext";



let systemUrl = window.location.origin;


 export const authAction = {

      login: (url, dispatch, data) => {

        axios.post(`${systemUrl}/${url}`, data)
        .then(res => {
            dispatch({type:'LOG_IN', payload: res})
        })
        .catch(error => {
            
            dispatch( { type: 'ERROR_LOGIN',
                        payload:error.response.data } )
        })
      }  

 }