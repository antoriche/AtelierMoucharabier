import React from 'react';
export class ModelsForm extends React.Component{

    render(){
        const form = JSON.parse(this.props.form||'{}');
        console.log(form);
        return (<div></div>);
    }
}