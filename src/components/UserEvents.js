import React, { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';
import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';

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
            return(
                <p>Chargement…</p>
            );
        }

        return(
            <section className="main">
                <Link to={"/"}>Retour au dashboard</Link>
                { this.props.events
                    ? this.props.events.map( event =>
                        <div key={event.id}>
                            <p>Nom: {event.course_name}</p>
                            <p>Année académique: {event.academic_year}</p>
                            <p>Session: {event.exam_session}</p>
                            <Link to={"/editEvent/"+event.id}>Modifier</Link>
                             -
                            <a href="#" data-event={event.id} onClick={this.handleDeleteButtonClick.bind(this)}>Supprimer</a>
                        </div>
                      )
                    : <p>Pas encore d'évènements</p>
                }
            </section>
        );
    }
}
