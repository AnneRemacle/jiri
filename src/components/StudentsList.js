import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as eventActions from '../actions/event';
import * as userActions from '../actions/user';
import * as meetingActions from '../actions/meeting';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    currentEvent: state.eventSelectors.currentEvent,
    eventStudents: state.eventSelectors.students,
    eventProjects: state.eventSelectors.projects,
    eventJurys: state.eventSelectors.jurys,
    meetings: state.userSelectors.meetings,
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
    getEventProjects(event_id) {
        dispatch( eventActions.getEventProjects(event_id) );
    },
    getEventJurys(event_id) {
        dispatch( eventActions.getEventJurys(event_id) );
    },
    getMeetings(event_id, user_id) {
        dispatch( userActions.getMeetings(event_id, user_id))
    },
    createMeeting( user_id, event_id, student_id ) {
        dispatch( meetingActions.createMeeting(user_id, event_id, student_id) )
    }
});

@connect(mapStateToProps, mapActionsToProps)
export default class StudentsList extends Component {
    constructor(oProps) {
        super(oProps);
        this.props.getCurrentEvent();

        this.handleCreateMeeting = this.handleCreateMeeting.bind(this);
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.currentEvent && this.props.currentEvent != oNextProps.currentEvent){
            this.props.getEventStudents(this.props.currentEvent.id);
            this.props.getEventProjects(this.props.currentEvent.id);
            this.props.getEventJurys(this.props.currentEvent.id);
            this.props.getMeetings(this.props.currentEvent.id, this.props.user.id);
        }
    }

    handleCreateMeeting(e){
        e.preventDefault();
        this.props.createMeeting(this.props.user.id, this.props.currentEvent.id, e.target.dataset.student);
    }

    renderStudents(){
        if(this.props.eventStudents && this.props.meetings){
            let allStudents = this.props.eventStudents,
                idOfstudentsInMeeting = this.props.meetings.map(meeting => meeting.student ? meeting.student.id : ""),
                handleCreateMeeting = this.handleCreateMeeting.bind(this);
            return (
                allStudents.map( function (student) {
                    if(!idOfstudentsInMeeting.includes(student.id)){
                        return (
                            <a href="#" data-student={student.id} onClick={handleCreateMeeting} className="item" key={student.id} title={ `Évaluer ${student.name}` }>
                                <span data-student={student.id} className="item__name">{student.name}</span>
                                <div data-student={student.id} className="choose-button buttons"><i data-student={student.id} className="fa fa-check"></i></div>
                            </a>
                        );
                    }
                })
            )

            if (allStudents.length == idOfstudentsInMeeting.length) {
                return (
                    <p>Vous avez vu tous les étudiants</p>
                );
            }
        }
    }

    renderStudentsInMeeting() {
        if(this.props.meetings){
            return this.props.meetings.map( (meeting) =>
                <Link to={`/editMeeting/${meeting.id}`} className="item" key={meeting.student ? meeting.student.id : ""}>
                    <span className="item__name">{meeting.student ? meeting.student.name : ""}</span>
                    <span  className="edit-button buttons" title="Modifier l'évaluation"><i className="fa fa-pencil"></i></span>
                </Link>
            )
        }
    }

    render() {
        if (!this.props.eventStudents) {
            return(
                <p>Chargement</p>
            );
        }
        return(
            <section className="section">
                <Link to={`/currentEvent`} className="back"><i className="fa fa-caret-left"></i>Retour à l'événement</Link>
                <h2 className="section__title">Évaluer un étudiant</h2>
                <p className="section__intro">Choisissez un étudiant dans la liste pour démarrer l'évaluation. Vous pourrez la modifier par la suite.</p>

                <section className="sub-section">
                    <h3 className="sub-section__title">Étudiants à voir</h3>

                        {this.renderStudents()}
                </section>



                <section className="sub-section">
                    <h3 className="sub-section__title">Étudiants que vous avez déjà rencontrés</h3>
                    {this.renderStudentsInMeeting()}
                </section>
            </section>
        );
    }
}
