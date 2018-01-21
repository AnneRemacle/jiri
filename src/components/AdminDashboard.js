import React, { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
});

@connect(mapStateToProps)
export default class AdminDashboard extends Component {
    render() {
        const {user} = this.props;

        if (!user) {
            return(
                <p>Chargement…</p>
            );
        }
        return(
            <section className="main">
                <h2 className="section__title">
                    Bonjour, {user.name}
                    <span className="section__title--small">Que voulez-vous faire?</span>
                </h2>

                <nav className="nav-second">
                    <h3 className="sro">Navigation secondaire</h3>
                    <Link to="/createEvent" className="nav-second__link">Créer un événement</Link>
                    <Link to="" className="nav-second__link">Voir l'événement en cours</Link>
                    <Link to="/my/events" className="nav-second__link">Événements que j'organise</Link>
                    <Link to="" className="nav-second__link">Événements passés</Link>
                </nav>
            </section>
        );
    }
}
