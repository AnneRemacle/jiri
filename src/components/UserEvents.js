import React, { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';
import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';

import Spinner from "./Spinner";

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    events: state.userSelectors.events
});

const mapActionsToProps = dispatch => ({
    getUserEvents(user_id){
        dispatch(userActions.getUserEvents(user_id))
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    deleteEvent(event_id, user_id){
        dispatch(eventActions.deleteEvent(event_id, user_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class AdminDashboard extends Component {
    constructor(oProps){
        super(oProps);
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }

        if(this.props.user){
            this.props.getUserEvents(this.props.user.id);
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.user && !this.props.user){
            this.props.getUserEvents(oNextProps.user.id);
        }
    }

    handleDeleteButtonClick(e){
        e.preventDefault();
        this.props.deleteEvent(e.target.dataset.event, this.props.user.id);
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
                <Link className="back" to={"/"}><i className="fa fa-caret-left"></i> Retour au dashboard</Link>
                <h2 className="section__title">Mes événements</h2>
                <div className="list">
                    { this.props.events.length != 0
                        ? this.props.events.map( event =>
                            <div key={event.id} className="item">
                                <Link className="item__name" to={`/showEvent/${event.id}`}>{event.course_name}</Link>
                                <p>Année académique: {event.academic_year}</p>
                                <p>Session: {event.exam_session}</p>
                                <Link className="edit-button buttons" to={"/editEvent/"+event.id} title={`modifier ${event.course_name}`}><i className="fa fa-pencil"></i></Link>
                                <a href="#" className="delete-button buttons" data-event={event.id} onClick={this.handleDeleteButtonClick.bind(this)}><i data-event={event.id} className="fa fa-trash"></i></a>
                            </div>
                          )
                        : <div>
                            <p>Vous n'avez pas encore créé d'événement</p>
                            <Link to="/createEvent" className="nav-second__link">Créer un événement</Link>
                        </div>
                    }
                </div>
            </section>
        );
    }
}
