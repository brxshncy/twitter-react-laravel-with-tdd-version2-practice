export const AuthReducer = (initialState,  action) => {
    switch (action.type ){
        case "LOG_IN":
                return {
                    ...initialState,
                    userData: action.payload
                }
        case "SIGN_UP":
                return "signup";
        case "ERROR_LOGIN":
                return {
                    ...initialState,
                    error: action.payload,
                    isInvalid: false
                }

    }
}