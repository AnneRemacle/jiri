import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    allJurys: state.userSelectors.jurys,
    jury: state.userSelectors.jury,
    getJuryPending: state.userSelectors.getPending,
    event: state.eventSelectors.event
});

const mapActionsToProps = dispatch => ({
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getJurys() {
        dispatch(userActions.getJurys());
    },
    getJury(user_id){
        dispatch(userActions.getJury(user_id))
    },
    editJury(data, user_id){
        dispatch(userActions.editJury(data, user_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class EditJury extends Component {
    constructor(oProps) {
        super(oProps);

        this.state = {
            name: "",
            email: "",
            photo: "",
            company: "",
            password: ""
        }
    }

    componentWillMount(){
        this.props.getJury(this.props.params.id);
        this.props.getJurys();

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.jury && oNextProps.jury != this.props.jury){
            this.setState({
                name: oNextProps.jury.name,
                email: oNextProps.jury.email,
                photo: oNextProps.jury.photo,
                company: oNextProps.jury.company,
                password: oNextProps.jury.clear_password
            })
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        var formData = new FormData();

        if(this.state.file) {
            var imagedata = e.target.querySelector("#photo").files[0];
            formData.append("picture", imagedata);
        }

        formData.append("email", this.state.email);
        formData.append("name", this.state.name);
        formData.append("company", this.state.company)
        formData.append("password", this.state.password);

        this.props.editJury( formData, this.props.params.id );
    }

    handleJuryNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleJuryEmailChange(e) {
        this.setState({
            email: e.target.value
        })
    }

    handleJuryCompanyChange(e) {
        this.setState({
            company: e.target.value
        })
    }

    handleJuryPasswordChange(e) {
        this.setState({
            password: e.target.value
        })
    }

    handlePictureChange(e){
        let reader = new FileReader();
        let file = e.target.files[0];

        reader.onloadend = () => {
          this.setState({
            file: file,
            imagePreviewUrl: reader.result,
          });
        }

        reader.readAsDataURL(file)
    }

    renderFigure(){
        if ( !this.props.jury || this.props.jury && this.props.jury.photo === null) {
            return (<figure className="edit-avatar__figure">
                <img src={ this.state.imagePreviewUrl ? this.state.imagePreviewUrl : "https://placeimg.com/200/200/people/grayscale"} className="edit-avatar__img" />
            </figure>);
        }
        return (
            <figure className="edit-avatar__figure">
                <img src={ this.state.imagePreviewUrl ? this.state.imagePreviewUrl :  `http://localhost:8000/img/users/${this.props.jury.photo}`} className="edit-avatar__img" />
            </figure>
        )
    }

    render() {
        if (this.props.getJuryPending) {
            return(
                <p>Chargement...</p>
            );
        }

        return(
            <section className="main">
                <Link  to="" className="back">Retour à l'événement</Link>

                <h2 className="section__title">Modifier le jury</h2>

                <form className="form form-regular" onSubmit={ this.handleSubmit.bind(this) } encType="multipart/form-data">
                    <div className="form-group">
                        <label htmlFor="email" className="form__label">Email</label>
                        <input value={this.state.email} list="students" type="email" name="email" id="email" placeholder="jon@snow.be" className="form__input" onChange={this.handleJuryEmailChange.bind(this)}/>
                        <datalist id='students'>
                            {
                                this.props.allJurys
                                ? this.props.allJurys.map( jury => <option key={jury.id} value={jury.email} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom</label>
                        <input value={this.state.name} type="text" id='name' name="name" placeholder="Jon Snow" className="form__input" onChange={this.handleJuryNameChange.bind(this)} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="company" className="form__label">Entreprise</label>
                        <input value={this.state.company} type="text" id='company' name="company" placeholder="Google" className="form__input" onChange={this.handleJuryCompanyChange.bind(this)} />
                    </div>
                    <div className="form-group">
                        <label className="form__label form__label--file" htmlFor="photo">
                            <section className="edit-avatar">
                                {this.renderFigure()}
                            </section>
                        </label>
                        <input className="hidden" type="file" name="photo" id="photo" onChange={ this.handlePictureChange.bind(this) }/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="password" className="form__label">Mot de passe</label>
                        <input value={this.state.password} type="text" id='password' name="password" className="form__input" onChange={this.handleJuryPasswordChange.bind(this)} />
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Enregistrer'/>
                    </div>
                </form>

            </section>
        );
    }
}
