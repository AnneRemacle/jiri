import React, { Component } from 'react';
import { connect } from "react-redux";
import { history } from '../store';

import * as userActions from '../actions/user';

const EMPTY_ERRORS = {
    email: [],
    password: []
};

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    error: state.userSelectors.error
});

const mapActionsToProps = dispatch => ({
    userConnect(email, password) {
        dispatch( userActions.userConnect(email, password) );
    }
});

@connect(mapStateToProps, mapActionsToProps)
export default class Login extends Component {
    constructor(oProps){
        super(oProps);

        this.state = {
            values: {
                email: "",
                password: "",
            },
            errors: {
                email: [],
                password: [],
            },
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.user){
            history.push("/");
        }
    }

    componentWillMount(){
        if(this.props.user){
            history.push("/");
        }
    }

    handleSubmit(e){
        e.preventDefault();

        this.setState({
            errors: {
                email: this.validateEmail(this.state.values.email),
                password: this.validatePassword(this.state.values.password),
            }
        });

        if(JSON.stringify(this.state.errors) === JSON.stringify(EMPTY_ERRORS)){
            this.props.userConnect(this.state.values.email, this.state.values.password)
        }
    }

    handleEmailChange(e){
        e.preventDefault();

        this.setState({
            values: {
                ...this.state.values,
                email: e.target.value
            },
            errors: {
                ...this.state.errors,
                email: this.validateEmail(e.target.value)
            }
        })
    }

    handlePasswordChange(e){
        e.preventDefault();

        this.setState({
            values: {
                ...this.state.values,
                password: e.target.value
            },
            errors: {
                ...this.state.errors,
                password: this.validatePassword(e.target.value)
            }
        })
    }

    validateEmail(sEmail){
        let aErrors = [];

        if(!sEmail){
            aErrors.push("Entrez votre email")
        }

        return aErrors;
    }

    validatePassword(sPassword){
        let aErrors = [];

        if(!sPassword){
            aErrors.push("Entrez un mot de passe")
        }

        return aErrors;
    }

    render() {
        return(
            <section className="colored">
                <h1 className="main__title">Jiri</h1>

                <section className="form-container">
                    <h2 className="form-container__title">Connexion</h2>

                    <form className="form" onSubmit={this.handleSubmit.bind(this)}>
                        <div className="form-group">
                            <label htmlFor="email" className="form__label">Email</label>
                            <input type="email" name="email" id="email" className="form__input" onChange={this.handleEmailChange.bind(this)}/>
                        </div>
                        <div className="form-group">
                            <label htmlFor="password" className="form__label">Mot de passe</label>
                            <input type="password" name="password" id="password" className="form__input" onChange={this.handlePasswordChange.bind(this)}/>
                        </div>
                        <div className="form-group">
                            <button type='submit' className="form__button button button__reverse">Connexion</button>
                        </div>
                    </form>
                </section>
            </section>
        );
    }
}
