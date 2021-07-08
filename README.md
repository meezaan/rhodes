## RHODES (RE) and MANISA (CE) in the same repository

manifest.yml 
============

Pre-requisites

1. Download Minikube to run Kubernetes locally
2. minikube start
3. Kubectl cli download

Steps to apply the manifest
============================

1. Create a namespace in minikube
kubectl create namespace {{YourNameSpace}}
2. Download the manifest.yml
3. Create the docker images for rhodes {{rhodes-image}} and manisa {{manisa-image}}
4. cd to Rhodes/rhodes 
5. docker build . -t {{your-docker-id}}/rhodes-image
6. cd to Rhodes/manisa
7. docker build . -t {{your-docker-id}}/manisa-image
8. login to docker hub on docker dashboard using {{your-docker-id}}
9. docker push {{your-docker-id}}/manisa-image
10. docker push {{your-docker-id}}/rhodes-image
11. Open the manifest.yaml
12. replace the image name and namespace names in the manifest.yaml
13. change the kubectl context to your namespace
    kubectl config set-context --current --namespace={{YourNamespace}}
14. kubectl apply -f ./manifest.yaml
15. This will create
        a. 2 deployments
        b. 2 services
        c. 1 Ingress
16. Once the pods and services are up and running , do a port forward 
kubectl port-forward <{{pod-Name}} {{device-port}}:{{container-port}}





