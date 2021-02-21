import React from 'react';
import { render } from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import  routes  from './Configs/route';
import { AuthContextProvider } from './Context/AuthContext';



const App = () => {
    
    return(
    <AuthContextProvider>

        <Router>

            <Switch>
                {routes.map((route) => (
                    <Route 
                        key={route.path}
                        path={route.path}
                        component={route.component}
                        isPrivate={route.isPrivate}
                    />
                ))}
            </Switch>

        </Router>

     </AuthContextProvider>
    )
}

export default App;

render(<App />, document.getElementById('app'));
