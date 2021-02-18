import React from 'react';
import { render } from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import Login from './auth/Login';
import Signup from './auth/Signup';
import Home from './pages/Home';
import { AuthContextProvider } from './context/AuthContext';



const App = () => {
    return(

        <Router>
            <AuthContextProvider>

                <Switch>

                    <Route path="/login" exact component={Login}></Route>

                    <Route path="/singup" exact component={Signup}></Route>

                    <Route path="/home" exact component={Home}></Route>

                </Switch>
            </AuthContextProvider>
        </Router>
      
    )
}

export default App;

render(<App />, document.getElementById('app'));
