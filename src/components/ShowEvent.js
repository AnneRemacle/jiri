import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    event: state.eventSelectors.event,
})

const mapActionsToProps = dispatch => ({
    getEvent( event_id ) {
        dispatch( eventActions.getEvent(event_id) )
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class ShowEvent extends Component {
    constructor(oProps) {
        super(oProps);
    }

    componentWillMount() {
        this.props.getEvent( this.props.params.id );
    }

    render() {
        const {event} = this.props;

        if (!event) {
            return(
                <p>Chargement</p>
            );
        }
        return(
            <section className="main">
                <h2 className="section__title">{event.course_name}</h2>

                <Link to={`/event/${event.id}/manageProjects`} className="button">Gérer les projets</Link>
            </section>
        );
    }
}
