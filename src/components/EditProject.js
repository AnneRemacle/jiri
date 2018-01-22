import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import * as projectActions from '../actions/project';
import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    allProjects: state.projectSelectors.projects,
    projectError: state.projectSelectors.error,
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    eventProjects: state.eventSelectors.projects,
    project: state.projectSelectors.project
});

const mapActionsToProps = dispatch => ({
    getProjects(){
        dispatch(projectActions.getProjects())
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getProject(project_id) {
        dispatch(projectActions.getProject(project_id))
    },
    getEventProjects(event_id){
        dispatch(eventActions.getEventProjects(event_id))
    },
    updateProject(name, description, project_id, event_id, user_id){
        dispatch(projectActions.updateProject(name, description, project_id, event_id, user_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class EditProject extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: this.props.project && this.props.project.name,
            description: this.props.project && this.props.project.description
        }
    }

    componentWillMount(){
        this.props.getProject(this.props.params.id);
        this.props.getEvent( this.props.event.id );
        this.props.getProjects();

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.project && oNextProps.project != this.props.project){
            this.setState({
                name: oNextProps.project.name,
                description: oNextProps.project.description
            })
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateProject(this.state.name, this.state.description, this.props.params.id, this.props.event.id, this.props.user.id);
    }

    handleProjectNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleDescriptionChange(e) {
        this.setState({
            description: e.target.value
        })
    }

    render() {
        if (!this.props.project) {
            return(
                <p>chargement</p>
            );
        }
        return(
            <section className="main">
                <Link to={`event/${this.props.params.id}/manageProjects`} className="back">Retour au dashboard</Link>

                <h2 className="section__title">Modifier le projet</h2>

                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom du projet</label>
                        <input list="projects" type="text" name="name" id="name" placeholder="CV à la manière de…" className="form__input" onChange={this.handleProjectNameChange.bind(this)} value={this.state.name}/>
                        <datalist id='projects'>
                            {
                                this.props.allProjects
                                ? this.props.allProjects.map( project => <option key={project.id} value={project.name} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="description" className="form__label">Description</label>
                        <textarea name="description" id="description" className="form__select" onChange={this.handleDescriptionChange.bind(this)} value={this.state.description ? this.state.description : ""} >
                        </textarea>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Enregistrer'/>
                    </div>
                </form>
            </section>
        );
    }
}
