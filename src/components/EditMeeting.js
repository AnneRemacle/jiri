import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import Spinner from "./Spinner";

import * as eventActions from '../actions/event';
import * as userActions from '../actions/user';
import * as meetingActions from '../actions/meeting';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    currentEvent: state.eventSelectors.currentEvent,
    meeting: state.meetingSelectors.meeting,
    implementations: state.studentSelectors.implementations
});

const mapActionsToProps = dispatch => ({
    getUser(token) {
        dispatch( userActions.getUser(token) );
    },
    getCurrentEvent() {
        dispatch( eventActions.getCurrentEvent() );
    },
    getStudentImplementations(event_id, student_id, meeting_id){
        dispatch( studentActions.getImplementations(event_id, student_id, meeting_id))
    },
    getMeeting(meeting_id){
        dispatch( meetingActions.getMeeting(meeting_id))
    },
    updateScores(data, general_evaluation, meeting_id, event_id, student_id){
        dispatch( meetingActions.updateScores(data, general_evaluation, meeting_id, event_id, student_id))
    },
});

@connect(mapStateToProps, mapActionsToProps)
export default class EditMeeting extends Component {
    constructor(oProps) {
        super(oProps);

        this.state = {
            panelsFlagOpeners: {},
            implementations: {},
            general_evaluation: 0
        }
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }

        this.props.getCurrentEvent();
        this.props.getMeeting(this.props.params.id);
    }

    componentWillReceiveProps(oNextProps){
        let implementations = {};

        if(oNextProps.meeting){
            this.setState({
                general_evaluation: oNextProps.meeting.general_evaluation
            })
        }

        if(oNextProps.currentEvent && oNextProps.meeting && this.props.implementations === null){
            this.props.getStudentImplementations(oNextProps.currentEvent.id, oNextProps.meeting.student.id, oNextProps.meeting.id);
        }

        if(oNextProps.implementations){
            Object.entries(oNextProps.implementations).map( implementation =>
                implementations[implementation[1].id] = {
                    "score": implementation[1].scores[0] ? implementation[1].scores[0].score : 0,
                    "comment": implementation[1].scores[0] ? implementation[1].scores[0].comment : ""
                }
            );

            this.setState({
                implementations: {
                    ...implementations
                }
            })
        }
    }

    handleSubmit(e){
        e.preventDefault();

        this.props.updateScores(this.state.implementations, this.state.general_evaluation, this.props.meeting.id, this.props.currentEvent.id, this.props.meeting.student.id);
        history.goBack();
    }

    handleToggleClick(e){
        e.preventDefault();
        let results = {};

        results[e.target.dataset.implementation] = !this.state.panelsFlagOpeners[e.target.dataset.implementation];

        this.setState({
            panelsFlagOpeners : {
                ...results
            }
        })
    }

    handleScoreChange(e){
        let results = {};

        results[e.target.dataset.implementation] = {
            score: e.target.value,
            comment: this.state.implementations[e.target.dataset.implementation] ? this.state.implementations[e.target.dataset.implementation].comment : ""
        };

        this.setState({
            implementations: {
                ...this.state.implementations,
                ...results
            }
        })
    }

    handleCommentChange(e){
        let results = {};

        results[e.target.dataset.implementation] = {
            comment: e.target.value,
            score: this.state.implementations[e.target.dataset.implementation] ? this.state.implementations[e.target.dataset.implementation].score : 0
        };

        this.setState({
            implementations:{
                ...this.state.implementations,
                ...results
            }
        })
    }

    handleEvaluationChange(e) {
        e.preventDefault();

        this.setState({
            general_evaluation: e.target.value
        })
    }

    render() {
        if(!this.props.implementations && !this.props.meeting){
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }

        return(

            <section className="section">
                <Link to={`/currentEvent/students`} className="back"><i className="fa fa-caret-left"></i>Retour à l'événement</Link>
                <h2 className="section__title">Rencontre avec {this.props.meeting.student.name}</h2>
                <p className="section__intro">Retrouvez ci-dessous les projets de l'étudiant ainsi que les URLs où vous pouvez les consulter.</p>
                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    {
                        this.props.implementations.map( implementation =>
                            <section className="item" key={implementation.id}>
                                <h3 className="item__name">{implementation.project ? implementation.project.name : ""}</h3>
                                <div className={this.state.panelsFlagOpeners[implementation.id] ? `toggle open` : `toggle hide`}>
                                    <div className="urls">
                                        <a target='_blank' rel="external" href={implementation.url_repo} className="urls__link">Voir le repo Github</a>
                                        <a target='_blank' rel="external" href={implementation.url_project} className="urls__link">Voir le projet</a>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="score" className="form__label">Cote pour {implementation.project ? implementation.project.name : "No name"}</label>
                                        <input value={this.state.implementations[`${implementation.id}`] ? this.state.implementations[`${implementation.id}`].score : 0} type="number" data-implementation={implementation.id} name="score" id="score" className="form__input" min="0" max="20" onChange={this.handleScoreChange.bind(this)}/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="comment" className="form__label">Commentaire</label>
                                        <textarea name="comment" data-implementation={implementation.id} id="comment" cols="30" rows="4" className="form__area" onChange={this.handleCommentChange.bind(this)} value={this.state.implementations[implementation.id] ? this.state.implementations[implementation.id].comment : ""}>
                                        </textarea>
                                    </div>
                                </div>
                                <div className="item__links">
                                    <a href="#" data-implementation={implementation.id} onClick={this.handleToggleClick.bind(this)} className={ this.state.panelsFlagOpeners[implementation.id] ? `hidden` : `item__more` }>Voir et coter le projet</a>
                                    <a href="#" data-implementation={implementation.id} onClick={this.handleToggleClick.bind(this)} className={ this.state.panelsFlagOpeners[implementation.id] ? `item__more` : `hidden` }>Fermer le projet</a>
                                </div>

                            </section>

                        )
                    }

                    <div className="item">
                        <div className="form-group">
                            <label htmlFor="evaluation" className="form__label">Évaluation globale de l'étudiant</label>
                            <input value={this.state.general_evaluation} type="number" name="evaluation" id="evaluation" className="form__input" min="0" max="20" onChange={this.handleEvaluationChange.bind(this)}/>
                        </div>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button button" value='Enregistrer'/>
                    </div>
                </form>
            </section>
        );
    }
}
