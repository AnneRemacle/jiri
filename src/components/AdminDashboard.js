import React, { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';

import Spinner from "./Spinner";

const mapStateToProps = state => ({
    user: state.userSelectors.user,
});

const mapActionsToProps = dispatch => ({
    getUser(token){
        dispatch(userActions.getUser(token))
    },
})

@connect(mapStateToProps, mapActionsToProps)
export default class AdminDashboard extends Component {
    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    render() {
        const {user} = this.props;

        if (!user) {
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }

        return(
            <section className="section">
                <h2 className="section__title">
                    Bonjour, {user.name}
                    <span className="section__title--small">Que voulez-vous faire?</span>
                </h2>

                <nav className="nav-second">
                    <h3 className="sro">Navigation secondaire</h3>
                    <Link to="/createEvent" className="nav-second__link">Créer un événement</Link>
                    <Link to="/currentEvent" className="nav-second__link">Voir l'événement en cours</Link>
                    <Link to="/my/events" className="nav-second__link">Événements que j'organise</Link>
                </nav>
            </section>
        );
    }
}
