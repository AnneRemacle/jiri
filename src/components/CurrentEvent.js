import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as eventActions from '../actions/event';
import * as userActions from '../actions/user';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    currentEvent: state.eventSelectors.currentEvent,
    eventStudents: state.eventSelectors.students,
    currentEventPending: state.eventSelectors.currentEventPending,
});

const mapActionsToProps = dispatch => ({
    getUser(token) {
        dispatch( userActions.getUser(token) );
    },
    getCurrentEvent() {
        dispatch( eventActions.getCurrentEvent() );
    },
    getEventStudents(event_id) {
        dispatch( eventActions.getEventStudents(event_id) );
    },
});

@connect(mapStateToProps, mapActionsToProps)
export default class CurrentEvent extends Component {
    constructor(oProps) {
        super(oProps);
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }

        this.props.getCurrentEvent();
    }

    componentDidUpdate(oPrevProps){
        if(oPrevProps.eventStudents === null){
            this.props.getEventStudents(this.props.currentEvent.id);
        }
    }

    renderTable(meetings){
        return (
            <div className="table-container">
                <table className='table'>
                    <thead className='table__head'>
                        {
                            meetings.map( function (meeting, index) {
                                if(index === 0){
                                    return (
                                        <tr key={meeting.id} className="table__row">
                                            <th className="scores__head--title"></th>
                                        {
                                            meeting.scores.map( score =>
                                                <th className="scores__head--title" key={score.implementation.project.id}>{score.implementation.project.name}</th>
                                            )
                                        }
                                        </tr>
                                    )
                                }

                            })
                        }
                    </thead>
                    <tbody className="table__body">
                        {
                            meetings.map( (meeting, index) =>
                                <tr key={meeting.id} className="table__row">
                                    <td className="table__cell">{meeting.user.name}</td>
                                    {
                                        meeting.scores.map( score =>
                                            <td className="table__cell" key={score.id}>{score.score}</td>
                                        )
                                    }
                                </tr>
                            )
                        }
                    </tbody>
                </table>
            </div>
        )
    }

    render() {
        console.warn(this.props.currentEvent, this.props.currentEventPending);
        if (this.props.currentEventPending || this.props.currentEvent === null) {
            return(
                <p>Chargement</p>
            )
        }

        return(
            <section className="section">
                <Link className="back" to="/"><i className="fa fa-caret-left"></i>Retour au dashboard</Link>
                <h2 className="section__title">{this.props.currentEvent.course_name}</h2>
                <Link to='/currentEvent/students'>Évaluer un étudiant</Link>

                { this.props.eventStudents ?
                    this.props.eventStudents.map( (student) =>
                    <section className="table-student" key={student.id}>
                        <h3 className="table-student__title">{student.name} <span className="small pull-right">Moyenne&nbsp;: {student.performances[0].calculated_score}</span></h3>

                        {this.renderTable(student.meetings)}
                    </section>)
                    : '' }
            </section>
        );
    }
}
