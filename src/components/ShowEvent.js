import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    event: state.eventSelectors.event,
    eventProjects: state.eventSelectors.projects,
    eventStudents: state.eventSelectors.students
})

const mapActionsToProps = dispatch => ({
    getEvent( event_id ) {
        dispatch( eventActions.getEvent(event_id) )
    },
    getEventProjects(event_id){
        dispatch(eventActions.getEventProjects(event_id))
    },
    getEventStudents(event_id){
        dispatch(eventActions.getEventStudents(event_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class ShowEvent extends Component {
    constructor(oProps) {
        super(oProps);
    }

    componentWillMount() {
        this.props.getEvent( this.props.params.id );
        this.props.getEventProjects( this.props.params.id );
        this.props.getEventStudents( this.props.params.id );
    }

    render() {
        const {event} = this.props;

        if (!event) {
            return(
                <p>Chargement</p>
            );
        }
        return(
            <section className="section">
                <Link className="back" to="my/events"><i className="fa fa-caret-left"></i>Mes événements</Link>
                <h2 className="section__title">{event.course_name}</h2>
                <nav className="nav-second">
                    <h3 className="sro">Options disponibles</h3>
                    <Link to={`/event/${event.id}/manageProjects`} className="nav-second__link">Gérer les projets</Link>
                    { this.props.eventProjects ?
                        <Link to={`/event/${event.id}/manageStudents`} className="nav-second__link">Gérer les étudiants</Link>
                        : ""
                     }
                     { this.props.eventStudents ?
                         <Link to={`/event/${event.id}/manageJurys`} className="nav-second__link">Gérer les jurys</Link>
                         : ""
                      }
                </nav>

            </section>
        );
    }
}
