import React from "react";
import ReactDOM from "react-dom";
import { ButtonToolbar, Button } from "react-bootstrap";

function ReactExample() {
    return (
        <div className="container app-container">
            <div className="row">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">
                            React Example Component
                        </div>

                        <div className="card-body">
                            <p>I'm a React example component!</p>
                            <ButtonToolbar>
                                <Button variant="primary">
                                    Bootstrap React Button Primary
                                </Button>
                                &nbsp;
                                <Button variant="outline-info">
                                    Bootstrap React Button Outline
                                </Button>
                            </ButtonToolbar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ReactExample;

if (document.getElementById("react-example")) {
    ReactDOM.render(<ReactExample />, document.getElementById("react-example"));
}
